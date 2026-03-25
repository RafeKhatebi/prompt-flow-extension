<x-app-layout>
    <x-slot name="header">Profile Settings</x-slot>

    <div style="max-width: 640px; display: grid; gap: 1.25rem;">
        <div class="pf-card p-4">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="pf-card p-4">
            @include('profile.partials.update-password-form')
        </div>
        <div class="pf-card p-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

    @if($errors->userDeletion->isNotEmpty())
        <script>document.addEventListener('DOMContentLoaded', () => new bootstrap.Modal(document.getElementById('deleteAccountModal')).show());</script>
    @endif
</x-app-layout>
