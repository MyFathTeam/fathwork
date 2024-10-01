const plugin = require("tailwindcss/plugin");

function withAlpha(variable) {
  return ({ opacityValue }) => {
    if (opacityValue === undefined) {
      return `var(${variable})`
    }
    return `rgb(var(${variable}) / ${opacityValue})`
  }
}

module.exports = plugin(function ({ addUtilities, matchUtilities, theme }) {
    const scrollbarTrackColorValue = (value) => ({
        '--scrollbar-track-bg': value,
        '&::-webkit-scrollbar-track': {
            "background-color": 'var(--scrollbar-track-bg)'
        },
        '&::-webkit-scrollbar-thumb': {
            "border-color": 'var(--scrollbar-track-bg)'
        }
    })

    const scrollbarTrackRoundedValue = (value) => ({
        '--scrollbar-track-radius': value,
        '&::-webkit-scrollbar-track': {
            "border-radius": 'var(--scrollbar-track-radius)'
        }
    });

    const scrollbarThumbColorValue = (value) => ({
        '--scrollbar-thumb-bg': value,
        '&::-webkit-scrollbar-thumb': {
            "background-color": 'var(--scrollbar-thumb-bg)'
        }
    });

    const scrollbarThumbRoundedValue = (value) => ({
        '--scrollbar-thumb-radius': value,
        '&::-webkit-scrollbar-thumb': {
            "border-radius": 'var(--scrollbar-thumb-radius)'
        }
    });

    addUtilities({
        '.scrollbar': {
            '--scrollbar-width': '12px',
            '&::-webkit-scrollbar': {
                'width': 'var(--scrollbar-width)'
            },
            '&::-webkit-scrollbar-thumb': {
                "border": '2px solid transparent'
            }
        },
        '.scrollbar-thin': {
            '--scrollbar-width': '2px',
            // 'scrollbar-width': 'thin',
            '&::-webkit-scrollbar': {
                'width': 'var(--scrollbar-width)'
            }
        },
        '.scrollbar-hidden': {
            '--scrollbar-width': '0px',
            // 'scrollbar-width': 'thin',
            '&::-webkit-scrollbar': {
                'width': 'var(--scrollbar-width)'
            }
        }
    });

    Object.entries(theme('colors')).forEach(([colorName, color]) => {
        switch (typeof color) {
            case 'object':
                matchUtilities(
                    {
                        [`scrollbar-track-${colorName}`]: (value) => (scrollbarTrackColorValue(value)),
                        [`scrollbar-thumb-${colorName}`]: (value) => (scrollbarThumbColorValue(value))
                    },
                    {
                        values: color
                    }
                )
                break;
            case 'function':
                addUtilities({
                    [`.scrollbar-track-${colorName}`]: scrollbarTrackColorValue(color({})),
                    [`.scrollbar-thumb-${colorName}`]: scrollbarThumbColorValue(color({}))
                })
                break;
            case 'string':
                addUtilities({
                    [`.scrollbar-track-${colorName}`]: scrollbarTrackColorValue(color),
                    [`.scrollbar-thumb-${colorName}`]: scrollbarThumbColorValue(color)
                })
                break;
        }
    });

    matchUtilities(
        {
            'scrollbar-track-rounded': (value) => (scrollbarTrackRoundedValue(value)),
            'scrollbar-thumb-rounded': (value) => (scrollbarThumbRoundedValue(value))
        },
        {
            values: theme('borderRadius')
        }
    )
});
