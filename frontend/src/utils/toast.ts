type ToastType = 'success' | 'error' | 'info';

export class Toast {
  static show(message: string, type: ToastType = 'info') {
    const el = document.createElement('div');

    const base =
      'fixed top-4 left-4 px-4 py-2 w-100 rounded shadow text-white transition-opacity';

    const colors = {
      success: 'bg-green-600',
      error: 'bg-red-600',
      info: 'bg-gray-800',
    };

    el.className = `${base} ${colors[type]}`;
    el.textContent = message;

    document.body.appendChild(el);

    setTimeout(() => {
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 300);
    }, 2500);
  }

  static success(msg: string) {
    this.show(msg, 'success');
  }

  static error(msg: string) {
    this.show(msg, 'error');
  }

  static info(msg: string) {
    this.show(msg, 'info');
  }
}