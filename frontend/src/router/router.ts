// src/router/router.ts

import { authStore } from '../store/auth.store';
import { MainLayout } from '../ui/layouts/MainLayout';

type Route = {
  path: string;
  component: (params?: Record<string, string>) => HTMLElement;
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
  /*
  private match(path: string): Route | undefined {
    return this.routes.find(r => r.path === path);
  } */

  private match(path: string): {route: Route; params: Record<string, string>} | null {
    for (const route of this.routes) {
      const paramNames: string[] = []

      const regexPath = route.path.replace(/:([^/]+)/g, (_, name) => {
        paramNames.push(name)
        return '([^/]+)'
      })

      const regex = new RegExp(`^${regexPath}$`)
      const match = path.match(regex)

      if (match) {
        const params: Record<string, string> = {}

        paramNames.forEach((name, i) => {
          params[name] = match[i + 1]
        })

        return { route, params }
      }
    }

    return null
  }
  /*
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
  }*/

  render() {
    const path = window.location.pathname

    const result = this.match(path);

    this.root.innerHTML = ''

    if (result) {
      const { route, params } = result

      const page = route.component(params)

      if (path === '/login') {
        this.root.appendChild(page)
      } else {
        this.root.appendChild(MainLayout(page))
      }

    } else {
      this.root.textContent = '404'
    }
  }
} 

