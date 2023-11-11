class Example{
    constructor(
        public nameBook: string,
        public years: number
    )
    { }
}

const obj:Example = new Example("Meditation", 2023);

export {Example, obj}