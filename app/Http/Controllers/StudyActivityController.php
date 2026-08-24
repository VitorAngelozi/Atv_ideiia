<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyActivityRequest;
use App\Models\StudyActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudyActivityController extends Controller
{
    private const STATUSES = ['pendente', 'em andamento', 'concluída'];

    private const PRIORITIES = ['baixa', 'média', 'alta'];

    public function dashboard(): View
    {
        $activities = StudyActivity::query();

        return view('dashboard', [
            'totalActivities' => (clone $activities)->count(),
            'pendingActivities' => (clone $activities)->where('status', 'pendente')->count(),
            'inProgressActivities' => (clone $activities)->where('status', 'em andamento')->count(),
            'completedActivities' => (clone $activities)->where('status', 'concluída')->count(),
            'upcomingActivities' => StudyActivity::query()
                ->whereDate('due_date', '>=', now()->toDateString())
                ->where('status', '!=', 'concluída')
                ->orderBy('due_date')
                ->limit(5)
                ->get(),
        ]);
    }

    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $discipline = $request->string('discipline')->toString();

        $activities = StudyActivity::query()
            ->withStatus($status ?: null)
            ->withDiscipline($discipline ?: null)
            ->orderByRaw("CASE status WHEN 'pendente' THEN 1 WHEN 'em andamento' THEN 2 ELSE 3 END")
            ->orderBy('due_date')
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', [
            'activities' => $activities,
            'disciplines' => StudyActivity::query()->select('discipline')->distinct()->orderBy('discipline')->pluck('discipline'),
            'statuses' => self::STATUSES,
            'selectedStatus' => $status,
            'selectedDiscipline' => $discipline,
        ]);
    }

    public function create(): View
    {
        return view('activities.create', [
            'statuses' => self::STATUSES,
            'priorities' => self::PRIORITIES,
        ]);
    }

    public function store(StudyActivityRequest $request): RedirectResponse
    {
        StudyActivity::create($request->validated());

        return redirect()->route('activities.index')->with('success', 'Atividade cadastrada com sucesso.');
    }

    public function edit(StudyActivity $activity): View
    {
        return view('activities.edit', [
            'activity' => $activity,
            'statuses' => self::STATUSES,
            'priorities' => self::PRIORITIES,
        ]);
    }

    public function update(StudyActivityRequest $request, StudyActivity $activity): RedirectResponse
    {
        $activity->update($request->validated());

        return redirect()->route('activities.index')->with('success', 'Atividade atualizada com sucesso.');
    }

    public function destroy(StudyActivity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Atividade excluída com sucesso.');
    }

    public function updateStatus(Request $request, StudyActivity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pendente,em andamento,concluída'],
        ]);

        $activity->update($validated);

        return back()->with('success', 'Status da atividade atualizado.');
    }
}
