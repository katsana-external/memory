<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->files()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/resources/config')
    ->in(__DIR__.'/resources/database')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return Symfony\CS\Config\Config::create()
    ->setUsingCache(true)
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers([
        '-psr0',
        'align_double_arrow',
        'align_equals',
        'blankline_after_open_tag',
        'concat_without_spaces',
        'double_arrow_multiline_whitespaces',
        'duplicate_semicolon',
        'empty_return',
        'extra_empty_lines',
        'include',
        'join_function',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'new_with_braces',
        'no_blank_lines_after_class_opening',
        'no_empty_lines_after_phpdocs',
        'object_operator',
        'operators_spaces',
        'phpdoc_indent',
        'phpdoc_inline_tag',
        'phpdoc_no_access',
        '-phpdoc_no_empty_return',
        'phpdoc_no_package',
        '-phpdoc_params',
        'phpdoc_scalar',
        'phpdoc_separation',
        'phpdoc_short_description',
        'phpdoc_to_comment',
        'phpdoc_trim',
        'phpdoc_type_to_var',
        'phpdoc_var_without_name',
        'remove_leading_slash_use',
        'remove_lines_between_uses',
        'short_array_syntax',
        'single_array_no_trailing_comma',
        'single_blank_line_before_namespace',
        'single_quote',
        'spaces_cast',
        'standardize_not_equal',
        'ternary_spaces',
        'trim_array_spaces',
        'unused_use',
        'whitespacy_lines',
        'visibility',
    ])
    ->finder($finder);
