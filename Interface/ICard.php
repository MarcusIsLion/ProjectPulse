<?php
interface ICard
{
    public function getFolder(): string;
    public function getFullPath(): string;
    public function getLanguageIdPopover(): int;
    public function getTypeData(): string;
    public function __toString(): string;
}
