export function showLoading() {
  const el = document.createElement('div');

  el.id = 'loading';
  el.className =
    'fixed inset-0 bg-black/40 flex items-center justify-center text-white';

  el.textContent = 'Loading...';

  document.body.appendChild(el);
}

export function hideLoading() {
  document.getElementById('loading')?.remove();
}