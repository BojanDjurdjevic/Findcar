import { api, getCsrfCooke } from "../api/axios"

export const authService = {
    async login(email: string, password: string) {
        await getCsrfCooke()

        await api.post("/login", {
            email,
            password
        })

        return this.me()
    },

    async me() {
        const res = await api.get("/api/user") 
        return res.data     
    },

    async logout() {
        await api.post("/logout")
    }
}