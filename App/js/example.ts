class Example{
    constructor(
        public nameBook: string,
        public years: number
    )
    { }
}

const obj:Example = new Example("Meditation", 2005);

export {Example, obj}