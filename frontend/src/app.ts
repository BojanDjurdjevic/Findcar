import { authService } from './services/auth.service';
import { authStore } from './store/auth.store';
import { router } from './main';

export async function initApp() {
  try {
    const user = await authService.me();
    authStore.setUser(user);
    router.navigate('/dashboard');
  } catch {
    router.navigate('/login');
  }
}