#include<stdio.h>
#include<stdlib.h>
typedef struct Stack{
	int capacity;
	int size;
	int *elements;
}Stack;

Stack * createStack(){
	int maxElements;
	printf("What is the maximum number of elements for this stack?");
	scanf_s("%d", &maxElements);
	Stack *S;
	S = (Stack *)malloc(sizeof(Stack));
	S->elements = (int *)malloc(sizeof(int)*maxElements);
	S->size = 0;
	S->capacity = maxElements;
	return S;
}
void pop(Stack *S){
	if (S->size == 0)
	{
		printf("Stack is Empty\n");
		return;
	}
	else
	{
		S->size--;
	}
	return;
}
int top(Stack *S){
	if (S->size == 0)
	{
		printf("Stack is Empty\n");
	}
	return S->elements[S->size - 1];
}
void push(Stack *S, int element){
	if (S->size == S->capacity){
		printf("Stack is Full\n");
	}
	else{
		S->elements[S->size++] = element;
	}
	return;
}
int main(){
	Stack *S = createStack();
	int value;
	int choice;
	int option = 1;
	while (option){
		printf(" 1) Create a stack\n");
		printf(" 2) Pop an integer\n");
		printf(" 3) Push in an integer\n");
		printf(" 4) Destroy a stack\n");
		printf(" 5) Top a stack\n");
		scanf_s("%d", &choice);

		switch (choice){
		case 1: //S = createStack();
			break;
		case 2: pop(S);
			break;
		case 3:
			printf("Enter the integer to push: ");
			scanf_s("%d", &value);
			push(S, value);
			break;
		case 4:
			break;
		case 5: top(S);
			break;
		case 6: return;
		}
	}
}