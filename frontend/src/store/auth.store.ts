type User = {
    id: number,
    name: string,
    email: string,
    phone: string | null,
    city: string | null,
    avatar: string | null
}

class AuthStore {
    user: User | null = null

    setUser(user: User | null) {
        this.user = user
    }

    get isAuthenticated() {
        return !!this.user
    }
}

export const authStore = new AuthStore()