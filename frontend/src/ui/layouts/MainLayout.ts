import { authStore } from '../../store/auth.store';
import { authService } from '../../services/auth.service';
import { router } from '../../main';
import { Toast } from '../../utils/toast';

export function MainLayout(content: HTMLElement): HTMLElement {
  const wrapper = document.createElement('div');

  wrapper.innerHTML = `
    <div class="min-h-screen bg-gray-100">
      
      <!-- Navbar -->
      <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="font-semibold text-lg">
          AutoMarket
        </div>

        <a href="#" id="nav-cars"
          class="text-gray-700 hover:text-black">
          Cars
        </a>

        <a href="#" id="nav-my-cars"
          class="text-gray-700 hover:text-black">
          My Cars
        </a>

        <div class="flex items-center gap-4">
          <span class="text-gray-600">
            ${authStore.user?.name ?? ''}
          </span>

          <button id="logout-btn"
            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
            Logout
          </button>
        </div>
      </nav>

      <!-- Content -->
      <main class="p-6 max-w-5xl mx-auto" id="app-content"></main>
    </div>
  `;

  
  const contentEl = wrapper.querySelector('#app-content')!;
  contentEl.appendChild(content);

  //carsPage:

  wrapper.querySelector('#nav-cars')!
  .addEventListener('click', (e) => {
    e.preventDefault();
    router.navigate('/cars');
  });

  //my-cars:

  const myCarsLink = wrapper.querySelector('#nav-my-cars') as HTMLElement;

  if (!authStore.isAuthenticated) {
    myCarsLink.style.display = 'none';
  }

  wrapper.querySelector('#nav-my-cars')!
  .addEventListener('click', (e) => {
    e.preventDefault();
    router.navigate('/my-cars');
  });

  // logout
  wrapper.querySelector('#logout-btn')!
    .addEventListener('click', async () => {
      await authService.logout();
      authStore.setUser(null);
      Toast.success('Logged out');
      router.navigate('/login');
    });

  return wrapper;
}