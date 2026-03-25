<section>
    <div class="mb-4">
        <div style="font-size:15px; font-weight:600; color:#ef4444; margin-bottom:4px;">Delete Account</div>
        <div style="font-size:13px; color:#6c757d;">Once deleted, all your prompts and data will be permanently removed.</div>
    </div>

    <button type="button" class="btn-pf-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        <i class="bi bi-trash me-1"></i>Delete My Account
    </button>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content" style="border-radius:14px; border:1px solid #e9ecef;">
                @csrf @method('delete')

                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-semibold" style="color:#ef4444;">Delete Account</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p style="font-size:13px; color:#6c757d; margin-bottom:1rem;">
                        This action is irreversible. All your prompts and data will be permanently deleted. Enter your password to confirm.
                    </p>

                    @if($errors->userDeletion->any())
                        <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.65rem .85rem; font-size:13px; color:#dc2626; margin-bottom:1rem;">
                            @foreach($errors->userDeletion->all() as $error)<div>{{ $error }}</div>@endforeach
                        </div>
                    @endif

                    <label class="pf-label" for="delete_password">Password</label>
                    <input id="delete_password" type="password" name="password" class="pf-input" placeholder="Enter your password" required>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-pf-ghost" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-pf-danger">Yes, Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</section>
