export function confirmModal(message: string): Promise<boolean> {
  return new Promise(resolve => {
    const overlay = document.createElement('div');

    overlay.className =
      'fixed inset-0 bg-black/50 flex items-center justify-center z-50';

    overlay.innerHTML = `
      <div class="bg-white rounded-lg p-6 w-full max-w-sm shadow">
        <h2 class="text-lg font-semibold mb-2">Confirm</h2>
        <p class="text-gray-600 mb-4">${message}</p>

        <div class="flex justify-end gap-2">
          <button id="cancel"
            class="px-3 py-1 border rounded bg-gray-600 hover:bg-gray-500 text-white">
            Cancel
          </button>

          <button id="confirm"
            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500">
            Delete
          </button>
        </div>
      </div>
    `;

    document.body.appendChild(overlay);

    overlay.querySelector('#confirm')!.addEventListener('click', () => {
      overlay.remove();
      resolve(true);
    });

    overlay.querySelector('#cancel')!.addEventListener('click', () => {
      overlay.remove();
      resolve(false);
    });
  });
}