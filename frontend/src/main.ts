import './style.css';

import { Router } from './router/router';
import { initApp } from './app';
import { LoginPage } from './pages/login';
import { DashboardPage } from './pages/dashboard';
import { CarsPage } from './pages/cars';
import { CarFormPage } from './pages/car-form';
import { MyCarsPage } from './pages/mycars';
import { CarShowPage } from './pages/car-show';

const root = document.querySelector('#app') as HTMLElement;

export const router = new Router(root);


router.register({ 
    path: '/login', 
    component: LoginPage 
});
router.register({ 
    path: '/dashboard', 
    component: DashboardPage 
});

router.register({
  path: '/cars',
  component: CarsPage,
});

router.register({
  path: '/my-cars',
  component: MyCarsPage,
  meta: { auth: true }
});

router.register({
  path: '/cars/create',
  component: CarFormPage,
});

router.register({
  path: '/cars/:id/edit',
  component: CarFormPage,
});

router.register({
  path: '/cars/:id',
  component: CarShowPage
}); 


initApp();