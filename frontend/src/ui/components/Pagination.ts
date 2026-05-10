type Props = {
  currentPage: number;
  lastPage: number;
  onPageChange: (page: number) => void;
};

export function Pagination({
  currentPage,
  lastPage,
  onPageChange
}: Props): HTMLElement {

  const wrapper = document.createElement('div');

  wrapper.className =
    'flex items-center justify-center gap-2 mt-6';

  // PREVIOUS
  const prev = document.createElement('button');
  prev.textContent = 'Prev';

  prev.disabled = currentPage === 1;

  prev.className =
    'px-3 py-1 border rounded disabled:opacity-50';

  prev.addEventListener('click', () => {
    onPageChange(currentPage - 1);
  });

  wrapper.appendChild(prev);

  // PAGESS numbers
  for (let i = 1; i <= lastPage; i++) {
    const btn = document.createElement('button');

    btn.textContent = String(i);

    btn.className =
      i === currentPage
        ? 'px-3 py-1 rounded bg-blue-500 text-white'
        : 'px-3 py-1 rounded border';

    btn.addEventListener('click', () => {
      onPageChange(i);
    });

    wrapper.appendChild(btn);
  }

  // NEXT
  const next = document.createElement('button');

  next.textContent = 'Next';

  next.disabled = currentPage === lastPage;

  next.className =
    'px-3 py-1 border rounded disabled:opacity-50';

  next.addEventListener('click', () => {
    onPageChange(currentPage + 1);
  });

  wrapper.appendChild(next);

  return wrapper;
}