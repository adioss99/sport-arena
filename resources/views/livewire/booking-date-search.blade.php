<div>
    <span class="flex flex-col gap-2 mt-5" for="dateInput">
        <label class="font-regular text-md"> Select Date</label>
        <input
            type="date"
            name="date"
            id="dateInput"
            min="{{ now()->format('Y-m-d') }}"
            max="{{ now()->addDays(30)->format('Y-m-d') }}"
            value="{{ session('date') ?? now()->format('Y-m-d') }}"
            class="border-1 border-indigo-400 rounded-md px-5 py-1 text-sm mb-2 max-w-60 focus:outline-indigo-400"
            wire:model.live="date"
        />
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dateInput = document.getElementById("dateInput");
                dateInput.addEventListener("click", function () {
                    this.showPicker && this.showPicker();
                });
            });
        </script>
    </span>

    <x-arena-table :arenas="$arenas" :bookedField="$bookings" />
</div>
