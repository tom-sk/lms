<?php

namespace App\DataTransferObjects;

class SlideUpdateData
{
    public function __construct(
        public string $slideId,
        public ?bool $slideComplete,
        public string $topicId,
        public string $moduleId,
    ) {
    }
}
