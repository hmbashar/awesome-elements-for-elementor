<?php
/**
 * Tests: plugin constants defined in tools.php
 *
 * @package AEFE_Tests
 */

namespace AEFE_Tests;

use PHPUnit\Framework\TestCase;

class Test_Constants extends TestCase {

    public static function setUpBeforeClass(): void {
        // Load tools.php once for the whole class.
        // Guard prevents double-define on subsequent test files.
        if ( ! defined( 'AEFE_VERSION' ) ) {
            require_once dirname( __DIR__ ) . '/tools.php';
        }
    }

    // ── Version ──────────────────────────────────────────────────────────────

    public function test_version_constant_defined(): void {
        $this->assertTrue( defined( 'AEFE_VERSION' ) );
    }

    public function test_version_is_string(): void {
        $this->assertIsString( AEFE_VERSION );
    }

    public function test_version_matches_plugin_header(): void {
        $file    = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        preg_match( '/\* Version:\s+([^\s]+)/', $file, $matches );
        $this->assertSame( $matches[1], AEFE_VERSION,
            'AEFE_VERSION constant must match the Version: plugin header.' );
    }

    public function test_version_matches_class_constant(): void {
        require_once dirname( __DIR__ ) . '/elementor-addon/includes/elementor-configuration.php';
        $this->assertSame( AEFE_VERSION, \AEFE_ELEMENTOR\Plugin::VERSION,
            'Plugin class VERSION must match the AEFE_VERSION constant.' );
    }

    // ── URL / Path ────────────────────────────────────────────────────────────

    public function test_url_constant_defined(): void {
        $this->assertTrue( defined( 'AEFE_URL' ) );
    }

    public function test_url_ends_with_slash(): void {
        $this->assertStringEndsWith( '/', AEFE_URL );
    }

    public function test_path_constant_defined(): void {
        $this->assertTrue( defined( 'AEFE_PATH' ) );
    }

    public function test_path_ends_with_slash(): void {
        $this->assertStringEndsWith( '/', AEFE_PATH );
    }

    public function test_aefe_uri_not_defined(): void {
        $this->assertFalse( defined( 'AEFE_URI' ),
            'AEFE_URI was removed in the audit — it must not be defined.' );
    }

    // ── Text domain ───────────────────────────────────────────────────────────

    public function test_textdomain_constant_defined(): void {
        $this->assertTrue( defined( 'AEFE_TEXTDOMAIN' ) );
    }

    public function test_textdomain_is_lowercase(): void {
        $this->assertSame( 'aefe', AEFE_TEXTDOMAIN,
            'Text domain must be lowercase "aefe".' );
    }

    // ── Hardcoded uppercase text domain strings ───────────────────────────────

    /** @dataProvider phpFilesProvider */
    public function test_no_hardcoded_uppercase_textdomain( string $file ): void {
        $contents = file_get_contents( $file );
        // Allow define('AEFE_TEXTDOMAIN','aefe') and constant references; disallow literal 'AEFE' as text domain arg
        $pattern = "/(?:esc_html__|__|_e|esc_html_e)\s*\(\s*['\"][^'\"]*['\"]\s*,\s*'AEFE'\s*\)/";
        $this->assertDoesNotMatchRegularExpression(
            $pattern,
            $contents,
            basename( $file ) . ' must not use uppercase \'AEFE\' as text domain.'
        );
    }

    public static function phpFilesProvider(): array {
        $base  = dirname( __DIR__ );
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator( $base, \FilesystemIterator::SKIP_DOTS )
        );
        $rows = [];
        foreach ( $files as $file ) {
            if ( $file->getExtension() !== 'php' ) { continue; }
            $path = $file->getPathname();
            if ( strpos( $path, '/vendor/' ) !== false ) { continue; }
            if ( strpos( $path, '/tests/' )  !== false ) { continue; }
            if ( strpos( $path, '/.git/' )   !== false ) { continue; }
            $rows[ basename( $path ) ] = [ $path ];
        }
        return $rows;
    }
}
