#include "assign1.h"

int main(void) {
	unsigned int num;
	char* digit;
	int temp;
	STACK* stack;

	stack = stackCreate();
	printf("Enter a base 10 number to be converted to base 16: ");
	scanf("%d", &num);

	while (num > 0) {
		//digit = (char*)malloc(sizeof(char));
		temp = num % 16; //get remainder of number when divided by 16
		if (temp < 10)
			temp = temp + 48; //if number is less than 10 refrence the asci codes 0-9
		else 
			temp = temp + 55; //else refrence the asci codes a-f
		digit = temp;
		stackPush(stack, digit); 
		num = num / 16;
	}

	printf("The base16 number is: ");
	while (!stackEmpty(stack)) {
		digit = (char*)stackPop(stack);
		printf("%c", digit);
	}
	printf("\n");
	stackDestroy(stack);
	return 0;
}