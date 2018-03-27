<?php

namespace App;

use DateTime;
use Carbon\Carbon;

trait Date {
    // This is for carbon dates.
    protected $dates = ['start', 'end'];

    // This is for view stuff (visibility and such).
    protected $applicable_filters = [];

    /**
     * Get all filters, that are applicable to this date.
     *
     * @return array
     */
    public function getApplicableFilters() {
        return $this->applicable_filters;
    }

    /**
     * Set the currently known applicable filters of this date (only the name of the Date).
     */
    protected function setApplicableFilters() {
        $this->applicable_filters[] = $this->getShortName();
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay() {
        return $this->getStart() == $this->getEnd()
            || $this->getStart()->addDay() == $this->getEnd();
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Check if this date has a place
     *
     * @return Boolean
     */
    public function hasPlace() {
        return isset($this->place);
    }

    /**
     * Getters for name of the class (needed for views).
     *
     * @return string
     */
    abstract function getShortName();
    abstract function getShortNamePlural();

    /**
     * Get the event's ID
     *
     * @return int|string|null
     */
    public function getId() {
        return $this->id;
    }

    public function needsAnswer() {
        return false;
    }

    /**
     * No need for old events.
     *
     * @param array $columns
     * @param bool $with_old
     * @return \Eloquent[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function all($columns = ['*'], $with_old = false) {
        if ($with_old) {
            return parent::all($columns);
        } else {
            return parent::where('end', '>=', Carbon::today())->get($columns);
        }
    }
}