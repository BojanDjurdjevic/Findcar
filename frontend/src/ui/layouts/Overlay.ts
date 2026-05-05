let loadingCount = 0;

export function showLoading() {
  loadingCount++;

  if (loadingCount === 1) {
    const el = document.createElement('div');
    el.id = 'loading';
    el.className =
      'fixed inset-0 bg-black/40 flex items-center justify-center text-white';
    el.textContent = 'Loading...';
    document.body.appendChild(el);
  }
}

export function hideLoading() {
  loadingCount--;

  if (loadingCount <= 0) {
    loadingCount = 0;
    document.getElementById('loading')?.remove();
  }
}