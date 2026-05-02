import { authService } from '../services/auth.service';
import { authStore } from '../store/auth.store';
import { router } from '../main';

export function LoginPage(): HTMLElement {
  const div = document.createElement('div');

  div.innerHTML = `
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow w-80">
        <h2 class="text-xl mb-4">Login</h2>

        <input id="email" placeholder="Email"
          class="border p-2 w-full mb-2" />

        <input id="password" type="password" placeholder="Password"
          class="border p-2 w-full mb-4" />

        <button id="login-btn"
          class="bg-blue-500 text-white px-4 py-2 w-full">
          Login
        </button>
      </div>
    </div>
  `;

  const btn = div.querySelector('#login-btn') as HTMLButtonElement;

  btn.addEventListener('click', async () => {
    const email = (div.querySelector('#email') as HTMLInputElement).value;
    const password = (div.querySelector('#password') as HTMLInputElement).value;

    try {
      const user = await authService.login(email, password);

      authStore.setUser(user);

      router.navigate('/dashboard');
    } catch (e) {
      alert('Login failed');
    }
  });

  return div;
}