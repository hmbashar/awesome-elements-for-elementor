<?php
/**
 * Tests: output escaping across every render template.
 *
 * @package AEFE_Tests
 */

namespace AEFE_Tests;

use PHPUnit\Framework\TestCase;

class Test_OutputEscaping extends TestCase {

    // ─── Helpers (data providers must be self-contained in PHPUnit 10) ────────

    private static function getAllPhpFiles(): array {
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

    private static function getRenderFiles(): array {
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
            if ( strpos( $path, '/widgets/' ) !== false ) {
                $rows[ basename( $path ) ] = [ $path ];
            }
        }
        return $rows;
    }

    // ── esc_url on AEFE_URL ───────────────────────────────────────────────────

    /** @dataProvider allPhpFilesProvider */
    public function test_aefe_url_always_escaped( string $file ): void {
        $src = file_get_contents( $file );
        $bad = preg_match( '/echo\s+AEFE_URL\b(?!\s*\)|\s*\.)/m', $src );
        $this->assertSame( 0, $bad,
            basename( $file ) . ': AEFE_URL must be wrapped in esc_url() before echo.' );
    }

    // ── No bare _e() ─────────────────────────────────────────────────────────

    /** @dataProvider allPhpFilesProvider */
    public function test_no_bare_e_function( string $file ): void {
        $src = file_get_contents( $file );
        $bad = preg_match( '/(?<![a-z_])_e\s*\(/', $src );
        $this->assertSame( 0, $bad,
            basename( $file ) . ': Use esc_html_e() instead of _e().' );
    }

    // ── No unescaped unique ID ────────────────────────────────────────────────

    /** @dataProvider renderFilesProvider */
    public function test_unique_id_escaped_in_render_files( string $file ): void {
        $src = file_get_contents( $file );
        if ( ! preg_match( '/\$unique_id|\$unique_ID/', $src ) ) {
            $this->addToAssertionCount( 1 );
            return;
        }
        preg_match_all( '/echo\s+\$unique_[Ii][Dd]\b/', $src, $raw );
        $this->assertEmpty( $raw[0],
            basename( $file ) . ': $unique_id must be echoed through esc_attr() or esc_js().' );
    }

    // ── No inline <script> tags in render files ───────────────────────────────

    /** @dataProvider renderFilesProvider */
    public function test_no_inline_script_tags( string $file ): void {
        $src = file_get_contents( $file );
        $bad = preg_match( '/<script\b/i', $src );
        $this->assertSame( 0, $bad,
            basename( $file ) . ': Inline <script> tags must not appear in render templates.' );
    }

    // ── WYSIWYG fields use wp_kses_post, not esc_html ────────────────────────

    public function test_accordion_wysiwyg_uses_wp_kses_post(): void {
        $file = dirname( __DIR__ ) . '/elementor-addon/includes/widgets/accordion/accordion-style-one.php';
        $src  = file_get_contents( $file );
        $this->assertStringContainsString( 'wp_kses_post', $src,
            'accordion-style-one.php must use wp_kses_post() for WYSIWYG content.' );
        $bad = preg_match( "/esc_html\s*\(\s*\\\$aefe_accordion_one\['aefe_accordion_content'\]\s*\)/", $src );
        $this->assertSame( 0, $bad,
            'accordion-style-one.php must not use esc_html() on WYSIWYG content.' );
    }

    // ── Pricing-table WYSIWYG uses wp_kses ───────────────────────────────────

    public function test_pricing_table_wysiwyg_uses_wp_kses(): void {
        $file = dirname( __DIR__ ) . '/elementor-addon/includes/widgets/pricing-table/pricing-table-ren.php';
        $src  = file_get_contents( $file );
        $this->assertStringContainsString( 'wp_kses', $src,
            'pricing-table-ren.php must use wp_kses() for WYSIWYG content.' );
    }

    // ── No duplicate 'selector' keys in add_group_control calls ──────────────

    public function test_no_duplicate_selector_keys_in_team_member(): void {
        $file = dirname( __DIR__ ) . '/elementor-addon/includes/widgets/teammember/team-member.php';
        $src  = file_get_contents( $file );
        $bad = preg_match( "/'selector'\s*=>[^\]]+\n[^\]]*'selector'\s*=>/s", $src );
        $this->assertSame( 0, $bad,
            'team-member.php must not contain duplicate "selector" keys in the same array.' );
    }

    // ─── Data providers ───────────────────────────────────────────────────────

    public static function allPhpFilesProvider(): array {
        return self::getAllPhpFiles();
    }

    public static function renderFilesProvider(): array {
        return self::getRenderFiles();
    }
}
