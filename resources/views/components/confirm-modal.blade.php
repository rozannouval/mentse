<div id="confirm-modal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-labelledby="confirm-title" aria-modal="true">
    <div class="fixed inset-0 bg-black/20" onclick="closeConfirmModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-gray-200 w-full max-w-sm mx-auto p-5">
            <h3 class="text-[15px] font-semibold text-gray-900 mb-1" id="confirm-title">Konfirmasi</h3>
            <p class="text-sm text-gray-500 leading-relaxed" id="confirm-message">Apakah Anda yakin?</p>
            <div class="flex items-center justify-end gap-2 mt-5 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors cursor-pointer">Batal</button>
                <button type="button" id="confirm-yes-btn" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors cursor-pointer"></button>
            </div>
        </div>
    </div>
</div>

<script>
function showConfirmModal(title, message, onConfirm, confirmText) {
    var modal = document.getElementById('confirm-modal');
    document.getElementById('confirm-title').textContent = title || 'Konfirmasi';
    document.getElementById('confirm-message').innerHTML = message || 'Apakah Anda yakin?';
    var btn = document.getElementById('confirm-yes-btn');
    btn.textContent = confirmText || 'Konfirmasi';
    btn.className = 'px-4 py-2 text-sm font-medium rounded-lg transition-colors cursor-pointer bg-gray-900 text-white hover:bg-gray-800';
    modal.classList.remove('hidden');
    btn.onclick = function() {
        closeConfirmModal();
        if (typeof onConfirm === 'function') onConfirm();
    };
}
function closeConfirmModal() {
    document.getElementById('confirm-modal').classList.add('hidden');
}
window.confirmAction = function(form, title, message, confirmText) {
    showConfirmModal(title || 'Konfirmasi', message || 'Apakah Anda yakin?', function() {
        form.submit();
    }, confirmText || 'Konfirmasi');
};
</script>