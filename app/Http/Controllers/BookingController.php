<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CreateBookingDto;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService) {}
    public function store(StoreBookingRequest $request)
    {
        $createBookingDto = CreateBookingDto::fromRequest($request);
        $booking = $this->bookingService->createBooking($request->user(), $createBookingDto);
        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully. Make payment',
            'booking' => new BookingResource($booking->load(['payment'])),
        ]);
    }
}
