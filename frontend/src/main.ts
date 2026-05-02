import './style.css';

import { Router } from './router/router';
import { initApp } from './app';
import { LoginPage } from './pages/login';
import { DashboardPage } from './pages/dashboard';

const root = document.querySelector('#app') as HTMLElement;

export const router = new Router(root);


router.register({ path: '/login', component: LoginPage });
router.register({ path: '/dashboard', component: DashboardPage });


initApp();