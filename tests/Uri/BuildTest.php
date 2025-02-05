<?php

declare(strict_types=1);

namespace Sabre\Uri;

class BuildTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider buildUriData
     *
     * @param string $value
     */
    public function testBuild($value): void
    {
        /** @var array<string, int|string> $parsedUrl */
        $parsedUrl = parse_url($value);
        $this->assertIsArray($parsedUrl);
        $this->assertEquals(
            $value,
            build($parsedUrl)
        );
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function buildUriData()
    {
        return [
            ['http://example.org/'],
            ['http://example.org/foo/bar'],
            ['//example.org/foo/bar'],
            ['/foo/bar'],
            ['http://example.org:81/'],
            ['http://user@example.org:81/'],
            ['http://user:pass@example.org:81/'],
            ['http://example.org:81/hi?a=b'],
            ['http://example.org:81/hi?a=b#c=d'],
            // [ '//example.org:81/hi?a=b#c=d'], // Currently fails due to a
            // PHP bug.
            ['/hi?a=b#c=d'],
            ['?a=b#c=d'],
            ['#c=d'],
            ['file:///etc/hosts'],
            ['file://localhost/etc/hosts'],
        ];
    }
}
