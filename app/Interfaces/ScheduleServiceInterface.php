<?php namespace App\Interfaces;

use Carbon\Carbon;

interface ScheduleServiceInterface
{
	public function isAvailableInterval($date, $doctorId, Carbon $start);
	public function getAvaliableIntervals($date, $doctorId);
}