@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-slate-100">Welcome to Your Dashboard</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage your students and staff efficiently.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-xl border border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 p-6 text-center">
                <h2 class="text-xl font-medium text-slate-900 dark:text-slate-100">Departments</h2>
                <span class="text-5xl font-bold text-indigo-600 dark:text-indigo-400">{{ $departmentCount }}</span>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700 p-6 text-center">
                <h2 class="text-xl font-medium text-slate-900 dark:text-slate-100">Programmes</h2>
                <span class="text-5xl font-bold text-indigo-600 dark:text-indigo-400">{{ $programmeCount }}</span>
            </div>
        </div>
    </div>
@endsection