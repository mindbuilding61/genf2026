<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\Rendering;

use Mindbuilding\Genf\Utility\CssValueUtility;
use TYPO3\CMS\Core\Settings\SettingsInterface;
use TYPO3\CMS\Core\Site\Entity\SiteInterface;

final class SiteCssVariablesRenderer
{
    public function render(): string
    {
        $site = $GLOBALS['TYPO3_REQUEST']?->getAttribute('site');
        if (!$site instanceof SiteInterface) {
            return '';
        }

        $settings = $site->getSettings();
        $vars = $this->buildVariables($settings);
        if ($vars === []) {
            return '';
        }

        $css = ':root{';
        foreach ($vars as $name => $value) {
            if ($value === '') {
                continue;
            }
            $css .= $name . ':' . $value . ';';
        }
        $css .= '}';

        return '<style id="genf-site-css-vars">' . $css . '</style>';
    }

    /**
     * @return array<string, string>
     */
    private function buildVariables(SettingsInterface $settings): array
    {
        $get = static fn (string $key): string => trim((string)($settings->get($key, '') ?? ''));

        $baseFamily = $get('plugin.genf.fonts.fontfamily');
        $family1 = $get('plugin.genf.fonts.family1') ?: $baseFamily;
        $family2 = $get('plugin.genf.fonts.family2') ?: $baseFamily;
        $family3 = $get('plugin.genf.fonts.family3') ?: $baseFamily;
        $family4 = $get('plugin.genf.fonts.family4') ?: $baseFamily;

        return [
            '--primarycolor' => CssValueUtility::normalizeColor($get('plugin.genf.fonts.primarycolor')),
            '--fontsize' => CssValueUtility::normalizeFontSize($get('plugin.genf.fonts.fontsize')),
            '--lineheight' => CssValueUtility::normalizeLineHeight($get('plugin.genf.fonts.lineheight')),
            '--fontfamily' => $this->quoteFontFamily($baseFamily),
            '--family1' => $this->quoteFontFamily($family1),
            '--family2' => $this->quoteFontFamily($family2),
            '--family3' => $this->quoteFontFamily($family3),
            '--family4' => $this->quoteFontFamily($family4),
            '--fontSizeH1' => CssValueUtility::normalizeFontSize($get('plugin.genf.fonts.fontSizeH1'), '2rem'),
            '--fontSizeH2' => CssValueUtility::normalizeFontSize($get('plugin.genf.fonts.fontSizeH2'), '1.7rem'),
            '--lineHeightH1' => CssValueUtility::normalizeCssLength($get('plugin.genf.fonts.lineHeightH1'), '1.6rem', 'rem'),
            '--lineHeightH2' => CssValueUtility::normalizeCssLength($get('plugin.genf.fonts.lineHeightH2'), '1.9rem', 'rem'),
            '--lineHeightH3' => CssValueUtility::normalizeCssLength($get('plugin.genf.fonts.lineHeightH3'), '1.7rem', 'rem'),
            '--lineHeightH4' => CssValueUtility::normalizeCssLength($get('plugin.genf.fonts.lineHeightH4'), '1.7rem', 'rem'),
            '--primarycolorh1' => CssValueUtility::normalizeColor($get('plugin.genf.fonts.primarycolorh1')),
            '--primarycolorh2' => CssValueUtility::normalizeColor($get('plugin.genf.fonts.primarycolorh2')),
            '--primarycolorh3' => CssValueUtility::normalizeColor($get('plugin.genf.fonts.primarycolorh3')),
            '--primarycolorh4' => CssValueUtility::normalizeColor($get('plugin.genf.fonts.primarycolorh4')),
            '--footerfarbe' => CssValueUtility::normalizeColor($get('plugin.genf.footer.footerfarbe')),
            '--footerfarbe2' => CssValueUtility::normalizeColor($get('plugin.genf.footer.footerfarbe2')),
            '--footerschriftoben' => CssValueUtility::clean($get('plugin.genf.footer.footerschriftoben')),
            '--footerschriftunten' => CssValueUtility::clean($get('plugin.genf.footer.footerschriftunten')),
            '--footerlinks' => CssValueUtility::normalizeColor($get('plugin.genf.footer.footerLinks')),
            '--footerrand' => CssValueUtility::clean($get('plugin.genf.footer.footerrand')),
            '--footerrandbreite' => CssValueUtility::clean($get('plugin.genf.footer.footerrandbreite')),
            '--buttoncolor' => CssValueUtility::normalizeColor($get('plugin.genf.button.buttoncolor')),
            '--buttonschriftfarbe' => CssValueUtility::normalizeColor($get('plugin.genf.button.buttonschriftfarbe')),
            '--buttonmargin' => CssValueUtility::clean($get('plugin.genf.button.buttonmargin')),
            '--buttonradius' => CssValueUtility::clean($get('plugin.genf.button.buttonradius')),
            '--buttonpadding' => CssValueUtility::clean($get('plugin.genf.button.buttonpadding')),
            '--buttonwidth' => CssValueUtility::clean($get('plugin.genf.button.buttonwidth')),
            '--burgerfarbe' => CssValueUtility::normalizeColor($get('plugin.genf.vorgaben.burgerfarbe')),
            '--siteLogoWidth' => CssValueUtility::normalizePixelSize($get('plugin.genf.sitelogo.siteLogoWidth')),
            '--sliderhoehe' => CssValueUtility::normalizeCssLength($get('plugin.genf.slider.sliderhoehe'), '324px', 'px'),
            '--farbeTrenner' => CssValueUtility::normalizeColor($get('plugin.genf.trenner.farbeTrenner')),
            '--hoehetrenner' => CssValueUtility::clean($get('plugin.genf.trenner.hoehetrenner')),
            '--abstandtrenneroben' => CssValueUtility::clean($get('plugin.genf.trenner.abstandtrenneroben')),
            '--abstandtrennerunten' => CssValueUtility::clean($get('plugin.genf.trenner.abstandtrennerunten')),
            '--containerclasscolor' => CssValueUtility::normalizeColor($get('plugin.genf.bereiche.containerclasscolor')),
            '--containerclasscolor2' => CssValueUtility::normalizeColor($get('plugin.genf.bereiche.containerclasscolor2')),
            '--containerclasscolor3' => CssValueUtility::normalizeColor($get('plugin.genf.bereiche.containerclasscolor3')),
            '--containerclasspadding' => CssValueUtility::clean($get('plugin.genf.bereiche.containerclasspadding')),
            '--containerclasspadding2' => CssValueUtility::clean($get('plugin.genf.bereiche.containerclasspadding2')),
            '--containerclasspadding3' => CssValueUtility::clean($get('plugin.genf.bereiche.containerclasspadding3')),
            '--accordioncolor' => CssValueUtility::normalizeColor($get('plugin.genf.accordion.accordioncolor')),
            '--accordioncolorueberschrift' => CssValueUtility::normalizeColor($get('plugin.genf.accordion.accordioncolorueberschrift')),
        ];
    }

    private function quoteFontFamily(string $font): string
    {
        $font = trim($font);
        if ($font === '') {
            return '';
        }

        if (str_contains($font, ' ')) {
            return '"' . str_replace('"', '\\"', $font) . '"';
        }

        return $font;
    }
}
