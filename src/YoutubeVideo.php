<?php

namespace PierreMiniggio\YoutubeAPI;

class YoutubeVideo
{

    public function __construct(
        protected string $channel,
        protected string $id,
        protected string $url,
        protected string $thumbnail,
        protected string $title,
        protected string $description,
        protected array $tags
    )
    {
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}
