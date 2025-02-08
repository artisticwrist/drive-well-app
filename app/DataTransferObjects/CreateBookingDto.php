<?php

namespace App\DataTransferObjects;

use App\Http\Requests\StoreBookingRequest;

readonly class CreateBookingDto
{
    public function __construct(
        public ?int $courseId,
        public int $duration,
    ) {}

    public static function fromRequest(StoreBookingRequest $request)
    {
        return new self(
            courseId: $request->validated('course_id'),
            duration: $request->validated('duration'),
        );
    }
}
