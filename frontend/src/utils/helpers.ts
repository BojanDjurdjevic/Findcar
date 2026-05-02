import { api } from "../api/axios";

export async function getCsrfCooke() {
    await api.get('sanctum/csrf-cookie')
}