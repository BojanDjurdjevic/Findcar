import { carService } from '../services/car.service';
import { CarCard } from '../ui/components/CarCard';

export function MyCarsPage(): HTMLElement {
  const wrapper = document.createElement('div');

  wrapper.innerHTML = `
    <h1 class="text-2xl font-semibold mb-4">My Cars</h1>

    <input 
      id="search"
      placeholder="Search my cars..."
      class="border p-2 mb-4 w-full"
    />

    <div id="cars" class="grid gap-4"></div>
  `;

  const carsContainer = wrapper.querySelector('#cars') as HTMLElement;
  const searchInput = wrapper.querySelector('#search') as HTMLInputElement;

  let cars: any[] = [];

  function render(list: any[]) {
    carsContainer.innerHTML = '';

    list.forEach(car => {
      carsContainer.appendChild(CarCard(car));
    });
  }

  // LOAD mycars
  carService.myCars().then(data => {
    cars = data;      
    render(cars);       
  });

  //SEARCH
  searchInput.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase();

    const filtered = cars.filter(car =>
      car.title.toLowerCase().includes(q) ||
      car.make.name.toLowerCase().includes(q) ||
      car.model.name.toLowerCase().includes(q)
    );

    render(filtered);
  });

  return wrapper;
}


/*
mport { carService } from '../services/car.service';
//import { authStore } from '../services/auth.service';
import { CarCard } from '../ui/components/CarCard';

export function MyCarsPage(): HTMLElement {
  const wrapper = document.createElement('div');

  wrapper.innerHTML = `
    <h1 class="text-2xl font-semibold mb-4">My Cars</h1>

    <input 
      id="search"
      placeholder="Search my cars..."
      class="border p-2 mb-4 w-full"
    />

    <div id="cars" class="grid gap-4"></div>
  `;

  const carsContainer = wrapper.querySelector('#cars') as HTMLElement;
  const searchInput = wrapper.querySelector('#search') as HTMLInputElement;

  //let cars = await carService.myCars();

  function render(list: any[]) {
    carsContainer.innerHTML = '';

    list.forEach(car => {
      carsContainer.appendChild(CarCard(car));
    });
  }

  let cars = carService.myCars().then(cars => {
        render(cars);
    });

  //render(cars);

  searchInput.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase();

    const filtered = cars.filter((car: any) =>
      car.title.toLowerCase().includes(q) ||
      car.make.name.toLowerCase().includes(q) ||
      car.model.name.toLowerCase().includes(q)
    );

    render(filtered);
  });

  return wrapper;
} */