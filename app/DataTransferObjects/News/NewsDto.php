<?php

namespace App\DataTransferObjects\News;

class NewsDto
{
    /**
     * @param string $title
     * @param string $content
     * @param array $categoryIds
     */
    public function __construct(
        public string $title,
        public string $content,
        public array $categoryIds,
    ) {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'category_ids' => $this->getCategoryIds(),
        ];
    }
}
