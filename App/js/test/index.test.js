import {add, resta} from "../hola.js";

describe('Addition', () => {
    test('given 3 and 7 as inputs, should return 10', () => {
        const expected = 10;
        const actual = add(3,7);
        expect(actual).toEqual(expected)
    });

    test('given -4 and 2 as inputs, should return -2', () => {
        const expected = -2;
        const actual = add(-4,2);
        expect(actual).toEqual(expected)
    });
    
    test('given 10 and 2 as inputs, should return 8', () => {
        expect(resta(10,2)).toEqual(8)
    });
});