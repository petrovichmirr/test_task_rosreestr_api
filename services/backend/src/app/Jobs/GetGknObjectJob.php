<?php

namespace App\Jobs;

use App\Logic\ExternalApi\ApiRosreestr;
use App\Logic\RealEstateObjects;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetGknObjectJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var string Кадастровый номер
     */
    private string $cadastralNumber;

    /**
     * @var string ID пользователя
     */
    private string $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($cadastralNumber, $userId)
    {
        $this->cadastralNumber = $cadastralNumber;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     * @throws GuzzleException
     */
    public function handle(): void
    {
        RealEstateObjects::handleGknData(ApiRosreestr::getGknObject($this->cadastralNumber), $this->userId);
    }
}
