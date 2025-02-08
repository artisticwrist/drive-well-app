<?php

namespace App\Services;

use App\DataTransferObjects\CreateBookingDto;
use App\DataTransferObjects\PaymentDto;
use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;

class BookingService
{
    public function __construct(protected PaymentService $paymentService) {}

    public function createBooking(User $user, CreateBookingDto $createBookingDto): Booking
    {
        $course = Course::findOrFail($createBookingDto->courseId);
        $amount = (int) $course->price * $createBookingDto->duration;
        $reference = $reference = 'DW-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        $paymentDto = new PaymentDto(
            email: $user->email,
            amount: $amount,
            reference: $reference
        );

        $payment = $this->paymentService->createPayment($paymentDto);
        $booking = Booking::create([
            'user_id' => $user->id,
            'course_id' => $createBookingDto->courseId,
            'payment_id' => $payment->id,
            'duration' => $createBookingDto->duration,
            'status' => BookingStatus::PENDING
        ]);
        return $booking;
    }
}
