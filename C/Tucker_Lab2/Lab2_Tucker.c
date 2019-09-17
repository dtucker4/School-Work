#include<stdio.h>
#include<stdlib.h>
#include <stdbool.h>

typedef struct node {
	void* dataPtr;
	struct node* link;
} STACK_NODE;

typedef struct {
	int count;
	STACK_NODE* top;
}STACK;

STACK* createStack(void) {
	STACK* stack;
	stack = (STACK*)malloc(sizeof(STACK));
	if (stack) {
		stack->count = 0;
		stack->top = NULL;
	}
	return stack;
}

bool pushStack(STACK* stack, void* dataInPtr) {
	STACK_NODE* newPtr;
	newPtr = (STACK_NODE*)malloc(sizeof(STACK_NODE));
	if (!newPtr)
		return false;
	newPtr->dataPtr = dataInPtr;
	newPtr->link = stack->top;
	stack->top = newPtr;
	(stack->count)++;
	return true;
}

void* popStack(STACK* stack) {
	void* dataOutPtr;
	STACK_NODE* temp;
	if (stack->count == 0)
		dataOutPtr = NULL;
	else{
		temp = stack->top;
		dataOutPtr = stack->top->dataPtr;
		stack->top = stack->top->link;
		free(temp);
		(stack->count)--;
	}
	return dataOutPtr;
}

void* stackTop(STACK* stack) {
	if (stack->count == 0)
		return NULL;
	else
		return stack->top->dataPtr;
}

STACK* destroyStack(STACK* stack) {
	STACK_NODE* temp;

	if (stack) {
		while (stack->top != NULL) {
			free(stack->top->dataPtr);
			temp = stack->top;
			stack->top = stack->top->link;
			free(temp);
		}free(stack);
	}return NULL;
}

int main() {
	int value;
	int choice;
	int option = 1;
	STACK* stack = NULL;
	
	while (option) {
		printf("\n 1) Create a stack\n");
		printf(" 2) Pop an integer\n");
		printf(" 3) Push in an integer\n");
		printf(" 4) Destroy a stack\n");
		printf(" 5) Top a stack\n");
		printf(" 6) Close program\n");
		scanf_s("%d", &choice);
		system("cls");
		switch (choice) {
		case 1: //CREATE STACK
			if (stack == NULL)
			stack = createStack();
			break;
		case 2: //POP
			if (stack != NULL)
				popStack(stack);
			else
				printf("no stack to pop");
			break;
		case 3: //PUSH 
			if (stack != NULL){
				printf("Enter the integer to push: ");
				scanf_s("%d", &value);
				pushStack(stack, value);
			}
			else {
				printf("No stack to push.");
			}
			break;
		case 4: //DESTROY A STACK
			if (stack == NULL)
				printf("No stack to destroy");
			else {
				destroyStack(stack);
			}
			break;
		case 5: //TOP
			if (stack == NULL)
				printf("No stack to top");
			else {
				printf("%d", (int *)stackTop(stack));
			}
			break;
		case 6: //close program 
			return;
		}
	}
}