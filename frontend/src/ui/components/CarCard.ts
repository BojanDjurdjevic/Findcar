import type { Car } from "../../types/car.types";


export function CarCard(car: Car): HTMLElement {
  const div = document.createElement('div');

  div.className = `
    bg-white rounded-xl shadow p-4
    hover:shadow-md transition
    flex flex-col gap-2
  `;

  div.innerHTML = `
    <div class="font-semibold text-lg">${car.title}</div>

    <div class="text-gray-600">
      ${car.year}
    </div>

    <div class="text-blue-600 font-bold">
      €${car.price}
    </div>
  `;

  return div;
}