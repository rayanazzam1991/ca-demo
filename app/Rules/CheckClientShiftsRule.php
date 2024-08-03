<?php

namespace App\Rules;

use App\Core\Shift\Domain\Enums\DaysOfWeekEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckClientShiftsRule implements ValidationRule
{
    protected ?array $shifts;

    public function __construct(?array $shifts)
    {
        $this->shifts = $shifts;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->shifts && is_array($this->shifts)) {
            $shifts = collect($this->shifts);
            foreach (DaysOfWeekEnum::asArray() as $dayOfWeek) {
                $dayShifts = $shifts
                    ->where('day_of_week', $dayOfWeek)
                    ->sortBy('start_time')
                    ->values()
                    ->all();
                $shiftCount = count($dayShifts);
                for ($i = 0; $i <= $shiftCount - 1; $i++) {
                    $shift1 = $dayShifts[$i];
                    if ($shift1['end_time'] <= $shift1['start_time']) {
                        $fail(trans('main.shifts_start_end_times', ['day' => trans('main.weekdays.' . $dayOfWeek), 'number' => $i + 1]));
                    }
                    if ($i + 1 < $shiftCount) {
                        $shift2 = $dayShifts[$i + 1];
                        if ($shift1['end_time'] > $shift2['start_time']) {
                            $fail(trans('main.shifts_overlapping_error', ['day' => trans('main.weekdays.' . $dayOfWeek)]));
                        }
                    }
                }
            }
        }
    }
}
