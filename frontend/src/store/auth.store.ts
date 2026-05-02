type User = {
    id: number,
    name: string,
    email: string,
    phone: string,
    city: string,
    avatar: string
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