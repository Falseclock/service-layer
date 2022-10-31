<?php
/**
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2022 Nurlan Mukhanov
 * @license   https://en.wikipedia.org/wiki/MIT_License MIT License
 * @link      https://github.com/Falseclock/service-layer
 */

declare(strict_types=1);

namespace Falseclock\Service\Tests\Validation\Validators;

use Falseclock\Service\Validation\Validators\IsUrl;
use PHPUnit\Framework\TestCase;

class IsUrlTest extends TestCase
{
    /** @noinspection PhpRedundantOptionalArgumentInspection */
    public function testCommon()
    {
        $validation = new IsUrl("message");

        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertFalse($validation->check(true));
        self::assertFalse($validation->check(false));
        self::assertFalse($validation->check(null));

        self::assertTrue($validation->check("ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt"));
        self::assertTrue($validation->check("gopher://spinaltap.micro.umn.example.edu/00/Weather/California/Los%20Angeles"));
        self::assertTrue($validation->check("http://www.math.uio.no.example.net/faq/compression-faq/part1.html"));
        self::assertTrue($validation->check("mailto:mduerst@ifi.unizh.example.gov"));
        self::assertTrue($validation->check("news:comp.infosystems.www.servers.unix"));
        self::assertTrue($validation->check("telnet://melvyl.ucop.example.edu/"));
        self::assertTrue($validation->check("https://www.ietf.org/rfc/rfc2396.txt"));
        self::assertTrue($validation->check("ldap://[2001:db8::7]/c=GB?objectClass?one"));
        self::assertTrue($validation->check("mailto:John.Doe@example.com"));
        self::assertTrue($validation->check("news:comp.infosystems.www.servers.unix"));
        self::assertTrue($validation->check("telnet://192.0.2.16:80/"));

        $validation = new IsUrl("message", true);
        self::assertFalse($validation->check(1));
        self::assertFalse($validation->check(1.234));
        self::assertFalse($validation->check("string"));
        self::assertFalse($validation->check([]));
        self::assertFalse($validation->check((object)[]));
        self::assertTrue($validation->check(null));
    }
}
