<?php

namespace App\Jobs;

use App\Logic\ExternalApi\ApiRosreestr;
use App\Logic\RealEstateObjects;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetGknObjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string Кадастровый номер
     */
    private string $cadastralNumber;

    /**
     * Create a new job instance.
     */
    public function __construct($cadastralNumber)
    {
        $this->cadastralNumber = $cadastralNumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        RealEstateObjects::handleGknData(ApiRosreestr::getGknObject($this->cadastralNumber));
    }
}
