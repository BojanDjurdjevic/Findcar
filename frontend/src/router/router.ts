// src/router/router.ts

import { authStore } from '../store/auth.store';
import { MainLayout } from '../ui/layouts/MainLayout';

type Route = {
  path: string;
  component: () => HTMLElement;
};

export class Router {
  private routes: Route[] = [];
  private root: HTMLElement;

  constructor(root: HTMLElement) {
    this.root = root;

    window.addEventListener('popstate', () => {
      this.render();
    });
  }

  register(route: Route) {
    this.routes.push(route);
  }

  navigate(path: string) {
    // Routes protect:
    if (!authStore.isAuthenticated && path !== '/login') {
      history.pushState({}, '', '/login');
    } else {
      history.pushState({}, '', path);
    }

    this.render();
  }

  private match(path: string): Route | undefined {
    return this.routes.find(r => r.path === path);
  }

  render() {
    const path = window.location.pathname;

    const route = this.match(path);

    this.root.innerHTML = '';

    if (route) {
    const page = route.component();

    if (window.location.pathname === '/login') {
        this.root.appendChild(page);
    } else {
        this.root.appendChild(MainLayout(page));
    }

    } else {
        this.root.textContent = '404 Not Found';
    }
  }
}