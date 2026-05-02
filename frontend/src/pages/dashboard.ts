import { authStore } from '../store/auth.store';
import { authService } from '../services/auth.service';
import { router } from '../main';

export function DashboardPage(): HTMLElement {
  const div = document.createElement('div');

  div.innerHTML = `
    <div class="p-6">
      <h1 class="text-2xl mb-4">
        Welcome ${authStore.user?.name}
      </h1>

      <button id="logout"
        class="bg-red-500 text-white px-4 py-2">
        Logout
      </button>
    </div>
  `;

  div.querySelector('#logout')!
    .addEventListener('click', async () => {
      await authService.logout();
      authStore.setUser(null);
      router.navigate('/login');
    });

  return div;
}