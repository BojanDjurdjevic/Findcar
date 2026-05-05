import { router } from "../../main";
import { carService } from "../../services/car.service";
import { authStore } from "../../store/auth.store";
import type { Car } from "../../types/car.types";
import { Toast } from "../../utils/toast";
import { hideLoading, showLoading } from "../layouts/Overlay";
import { confirmModal } from "./ConfirmModal";


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
  
  if (car.user_id === authStore.userId) {
  
    const editBtn = document.createElement('button');
    editBtn.textContent = 'Edit';
    editBtn.className = 'text-sm text-blue-500';

    editBtn.addEventListener('click', () => {
      router.navigate(`/cars/${car.id}/edit`);
    });

    div.appendChild(editBtn)

    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';
    deleteBtn.className = 'text-red-500 text-sm';

    deleteBtn.onclick = async () => {

      const confirmed = await confirmModal('Are you sure you want to delete this car?');

      if (!confirmed) return;

      showLoading();

      try {
        deleteBtn.disabled = true;
        deleteBtn.textContent = 'Deleting...';

        await carService.delete(car.id);

        Toast.success('Car deleted');

        div.remove();

      } catch (e: any) {
        const status = e?.response?.status;

        if (status === 403) {
          Toast.error('Not allowed');
        } else {
          Toast.error('Delete failed');
        }

      } finally {
        hideLoading();
        deleteBtn.disabled = false;
        deleteBtn.textContent = 'Delete';
      }
    };

    div.appendChild(deleteBtn);
  }

  return div;
}