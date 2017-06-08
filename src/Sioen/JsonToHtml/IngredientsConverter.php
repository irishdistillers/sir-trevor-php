<?php

namespace Sioen\JsonToHtml;

final class IngredientsConverter implements Converter
{
    public function toHtml(array $data)
    {
        // the <strong>..</strong> element gets replaced by DrinksController.php (e.g. see the JW.com repo)
        $html = '<p><strong>Ingredients</strong></p>';
        $html .= '<ul>';
        foreach ($data['listItems'] as $listItem) {
            $html .= '<li itemprop="recipeIngredient">'.$listItem['content'].'</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function matches($type)
    {
        return $type === 'ingredients';
    }
}
