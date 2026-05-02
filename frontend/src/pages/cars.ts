import { carService } from '../services/car.service';
import { CarCard } from '../ui/components/CarCard';
import { router } from '../main';

export function CarsPage(): HTMLElement {
  const wrapper = document.createElement('div');

  wrapper.innerHTML = `
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-semibold">Cars</h1>

      <button id="create-btn"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        + Add Car
      </button>
    </div>

    <div id="cars-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div>Loading...</div>
    </div>
  `;

  const list = wrapper.querySelector('#cars-list')!;

  // fetch data
  carService.getAll()
    .then(cars => {
      list.innerHTML = '';

      cars.forEach(car => {
        const card = CarCard(car);
        list.appendChild(card);
      });
    })
    .catch(() => {
      list.innerHTML = `<div class="text-red-500">Failed to load</div>`;
    });

  // create button
  wrapper.querySelector('#create-btn')!
    .addEventListener('click', () => {
      router.navigate('/cars/create');
    });

  return wrapper;
}