<?php
/**
 * Tests: asset registration and widget dependency declarations.
 *
 * @package AEFE_Tests
 */

namespace AEFE_Tests;

use PHPUnit\Framework\TestCase;

class Test_AssetRegistration extends TestCase {

    // ─── Helpers (data providers must be self-contained in PHPUnit 10) ────────

    private static function getWidgetFiles(): array {
        $files = glob(
            dirname( __DIR__ ) . '/elementor-addon/includes/widgets/*/*.php'
        );
        $files = array_filter(
            $files,
            fn( $f ) => ! preg_match( '/-(ren|one|two|three|style-one|style-two|style-three)\.php$/', $f )
        );
        $rows = [];
        foreach ( $files as $path ) {
            $rows[ basename( $path ) ] = [ $path ];
        }
        return $rows;
    }

    private static function getCarouselWidgetFiles(): array {
        $carousel = [ 'testimonial.php', 'team-member.php' ];
        $rows = [];
        foreach ( self::getWidgetFiles() as $key => $args ) {
            if ( in_array( $key, $carousel, true ) ) {
                $rows[ $key ] = $args;
            }
        }
        return $rows;
    }

    // ── tools.php registers expected handles ─────────────────────────────────

    /** @dataProvider expectedStyleHandlesProvider */
    public function test_style_handle_registered( string $handle ): void {
        $src = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        $this->assertStringContainsString(
            "wp_register_style( '{$handle}'",
            $src,
            "tools.php must register style handle '{$handle}'."
        );
    }

    public static function expectedStyleHandlesProvider(): array {
        return [
            [ 'aefe-owlcarousel' ],
            [ 'aefe-barfilter'   ],
            [ 'aefe-main'        ],
            [ 'aefe-responsive'  ],
        ];
    }

    /** @dataProvider expectedScriptHandlesProvider */
    public function test_script_handle_registered( string $handle ): void {
        $src = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        $this->assertStringContainsString(
            "wp_register_script( '{$handle}'",
            $src,
            "tools.php must register script handle '{$handle}'."
        );
    }

    public static function expectedScriptHandlesProvider(): array {
        return [
            [ 'aefe-owlcarousel' ],
            [ 'aefe-main'        ],
        ];
    }

    // ── No global enqueue in tools.php ───────────────────────────────────────

    public function test_no_global_enqueue_style_in_tools(): void {
        $src = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        $this->assertDoesNotMatchRegularExpression(
            '/wp_enqueue_style\s*\(/',
            $src,
            'tools.php must not call wp_enqueue_style() — use wp_register_style() only.'
        );
    }

    public function test_no_global_enqueue_script_in_tools(): void {
        $src = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        // Use regex to match wp_enqueue_script( but NOT wp_enqueue_scripts (the hook name)
        $this->assertDoesNotMatchRegularExpression(
            '/wp_enqueue_script\s*\(/',
            $src,
            'tools.php must not call wp_enqueue_script() — use wp_register_script() only.'
        );
    }

    // ── Asset versions use AEFE_VERSION ──────────────────────────────────────

    public function test_assets_use_version_constant(): void {
        $src = file_get_contents( dirname( __DIR__ ) . '/tools.php' );
        preg_match_all( '/wp_register_(?:style|script)\(.*$/m', $src, $matches );
        foreach ( $matches[0] as $line ) {
            $this->assertStringContainsString(
                'AEFE_VERSION',
                $line,
                "Asset registration line must use AEFE_VERSION: {$line}"
            );
        }
    }

    // ── Each widget declares its style/script dependencies ───────────────────

    /** @dataProvider widgetFilesProvider */
    public function test_widget_declares_style_depends( string $file ): void {
        $src = file_get_contents( $file );
        $this->assertStringContainsString(
            'get_style_depends',
            $src,
            basename( $file ) . ' must declare get_style_depends().'
        );
    }

    /** @dataProvider widgetFilesProvider */
    public function test_widget_style_depends_returns_array( string $file ): void {
        $src = file_get_contents( $file );
        $this->assertMatchesRegularExpression(
            '/get_style_depends\s*\(\s*\)[^{]*\{[^}]*return\s*\[/s',
            $src,
            basename( $file ) . ': get_style_depends() must return an array.'
        );
    }

    /** @dataProvider widgetFilesProvider */
    public function test_widget_style_depends_includes_aefe_main( string $file ): void {
        $src = file_get_contents( $file );
        preg_match( '/get_style_depends[^}]+}/s', $src, $m );
        if ( empty( $m[0] ) ) {
            $this->fail( basename( $file ) . ': get_style_depends() not found.' );
        }
        $this->assertStringContainsString(
            "'aefe-main'",
            $m[0],
            basename( $file ) . ': get_style_depends() must include "aefe-main".'
        );
    }

    /** @dataProvider carouselWidgetFilesProvider */
    public function test_carousel_widgets_declare_owlcarousel_style( string $file ): void {
        $src = file_get_contents( $file );
        preg_match( '/get_style_depends[^}]+}/s', $src, $m );
        $this->assertStringContainsString(
            "'aefe-owlcarousel'",
            $m[0] ?? '',
            basename( $file ) . ': carousel widget must list "aefe-owlcarousel" in get_style_depends().'
        );
    }

    /** @dataProvider carouselWidgetFilesProvider */
    public function test_carousel_widgets_declare_owlcarousel_script( string $file ): void {
        $src = file_get_contents( $file );
        preg_match( '/get_script_depends[^}]+}/s', $src, $m );
        $this->assertStringContainsString(
            "'aefe-owlcarousel'",
            $m[0] ?? '',
            basename( $file ) . ': carousel widget must list "aefe-owlcarousel" in get_script_depends().'
        );
    }

    // ─── Data providers ───────────────────────────────────────────────────────

    public static function widgetFilesProvider(): array {
        return self::getWidgetFiles();
    }

    public static function carouselWidgetFilesProvider(): array {
        return self::getCarouselWidgetFiles();
    }
}
