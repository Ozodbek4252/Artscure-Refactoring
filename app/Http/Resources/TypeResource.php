<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (count($this->images)>0) {
            $image = new ImageResource($this->images[0]);
        } else {
            $image = null;
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name_uz' => $this->name_uz,
            'name_ru' => $this->name_ru,
            'name_en' => $this->name_en,
            'views' => $this->views,
            'image' => $image
        ];
    }
}
