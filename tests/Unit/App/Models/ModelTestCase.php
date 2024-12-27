<?php

namespace Tests\Unit\App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

abstract class ModelTestCase extends TestCase
{
    abstract protected function model(): Model;
    abstract protected function traitsExpected(): array;
    abstract protected function fillableExpected(): array;
    abstract protected function castsExpected(): array;

    public function testTraits(): void
    {
        $modelTraits = array_keys(class_uses($this->model()));

        $this->assertEquals($this->traitsExpected(), $modelTraits);
    }

    public function testFillable(): void
    {
        $fillable = $this->model()->getFillable();

        $this->assertEquals($this->fillableExpected(), $fillable);
    }

    public function testIncrementingIsFalse(): void
    {
        $this->assertFalse($this->model()->getIncrementing());
    }

    public function testHasCasts(): void
    {
        $casts = $this->model()->getCasts();

        $this->assertEquals($this->castsExpected(), $casts);
    }
}
