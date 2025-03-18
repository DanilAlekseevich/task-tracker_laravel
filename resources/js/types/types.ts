export interface Project {
    id: number;
    name: string;
    descritption: string;
}

export interface Board {
    id: number;
    name: string;
    description: string;
    columns: Column[]
}

export interface Column {
    id: number;
    boardId: number;
    name: string;
    order: number;
}
